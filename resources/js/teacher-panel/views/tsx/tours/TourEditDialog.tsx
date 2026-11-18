import React, { useEffect, useState } from 'react';
import { Alert, Button, Dialog, DialogActions, DialogContent, DialogTitle, Grid, Stack, TextField, Typography } from '@mui/material';
import axios from '../../../../axiosConfig';
import { route } from '../../../helpers';

type Day = { id?: number; title: string; description: string; start: number | string; end: number | string };
type Data = { id: string; title: string; subtitle: string; short_summary: string; tour_overview: string; itineraries: Day[] };

export default function TourEditDialog({ open, data, onClose, onSaved }: {
    open: boolean; data: Data; onClose: () => void; onSaved: () => void;
}) {
    const [form, setForm] = useState<Data>(data);
    const [saving, setSaving] = useState(false);
    const [error, setError] = useState('');
    useEffect(() => { if (open) { setForm(JSON.parse(JSON.stringify(data))); setError(''); } }, [open, data]);
    const field = (key: string, value: string) => setForm(current => ({ ...current, [key]: value }));
    const dayField = (index: number, key: string, value: string) => setForm(current => ({ ...current,
        itineraries: current.itineraries.map((day, i) => i === index ? { ...day, [key]: ['start', 'end'].includes(key) && value !== '' ? Number(value) : value } : day),
    }));
    const save = async (event: React.FormEvent) => {
        event.preventDefault(); setSaving(true); setError('');
        const patch: any = {};
        for (const key of ['title', 'subtitle', 'short_summary', 'tour_overview']) {
            if (form[key] !== data[key]) patch[key] = form[key];
        }
        const days = form.itineraries.flatMap(day => {
            if (!day.id) return [day];
            const original = data.itineraries.find(item => item.id === day.id);
            const changed: any = { id: day.id };
            for (const key of ['title', 'description', 'start', 'end']) {
                if (String(day[key] ?? '') !== String(original?.[key] ?? '')) changed[key] = day[key];
            }
            return Object.keys(changed).length > 1 ? [changed] : [];
        });
        if (days.length) patch.itineraries = days;
        try {
            await axios.put(route('api.web.v1.teacher-panel.tours.update', { tour: data.id }), patch);
            onSaved();
        } catch (failure: any) {
            setError(failure.response?.status === 403 ? 'You cannot edit this tour.' : 'Unable to save. Check the submitted tour and day values.');
        } finally { setSaving(false); }
    };
    return <Dialog open={open} onClose={saving ? undefined : onClose} fullWidth maxWidth="md">
        <form onSubmit={save}>
            <DialogTitle>Edit tour</DialogTitle>
            <DialogContent><Stack spacing={2} sx={{ pt: 1 }}>
                {error && <Alert severity="error">{error}</Alert>}
                {(['title', 'subtitle', 'short_summary', 'tour_overview'] as const).map((key, index) =>
                    <TextField key={key} label={['Tour name', 'Subtitle', 'Summary', 'Tour overview'][index]} value={form[key] ?? ''}
                        onChange={event => field(key, event.target.value)} multiline={index > 1} inputProps={{ maxLength: 250 }}/>
                )}
                <Typography>Add or revise the days you want to change.</Typography>
                {form.itineraries.map((day, index) => <Stack key={day.id ?? `new-${index}`} spacing={1}>
                    <Typography variant="h6">Itinerary {index + 1}</Typography>
                    <TextField label={`Itinerary ${index + 1} title`} value={day.title ?? ''} onChange={event => dayField(index, 'title', event.target.value)} inputProps={{ maxLength: 25 }}/>
                    <TextField label={`Itinerary ${index + 1} description`} value={day.description ?? ''} onChange={event => dayField(index, 'description', event.target.value)} inputProps={{ maxLength: 25 }}/>
                    <Grid container spacing={1}>
                        {(['start', 'end'] as const).map(key => <Grid item xs={6} key={key}>
                            <TextField type="number" label={`Itinerary ${index + 1} ${key} day`} value={day[key] ?? ''}
                                onChange={event => dayField(index, key, event.target.value)} inputProps={{ min: 1, max: 50 }}/>
                        </Grid>)}
                    </Grid>
                </Stack>)}
                <Button onClick={() => { const next = Math.max(0, ...form.itineraries.map(day => Number(day.end) || 0)) + 1;
                    setForm(current => ({ ...current, itineraries: [...current.itineraries, { title: '', description: '', start: next, end: next }] }));
                }} disabled={saving || form.itineraries.length >= 50}>Add itinerary day</Button>
            </Stack></DialogContent>
            <DialogActions><Button onClick={onClose} disabled={saving}>Cancel</Button>
                <Button type="submit" variant="contained" disabled={saving}>Save changes</Button></DialogActions>
        </form>
    </Dialog>;
}
