import { readFile } from 'node:fs/promises';

const manifestPath = new URL('../public/build/manifest.json', import.meta.url);
const manifest = JSON.parse(await readFile(manifestPath, 'utf8'));

const expectedEntries = [
    'resources/js/public.js',
    'resources/js/react-public.js',
    'resources/scss/material-public.scss',
    'resources/js/material-public.js',
    'resources/scss/public.scss',
    'resources/js/admin-panel.js',
    'resources/js/manager-panel.js',
    'resources/js/teacher-panel.js',
    'resources/js/agent-panel.js',
    'resources/js/user-panel.js',
    'resources/js/app.jsx',
    'resources/scss/user-panel.scss',
];

const invalidEntries = expectedEntries.filter((entry) => {
    const output = manifest[entry];

    return !output || output.isEntry !== true || typeof output.file !== 'string';
});

if (invalidEntries.length > 0) {
    throw new Error(`Missing or invalid Vite manifest entries: ${invalidEntries.join(', ')}`);
}

console.log(`Verified ${expectedEntries.length} Vite entry points, including all five application panels.`);
