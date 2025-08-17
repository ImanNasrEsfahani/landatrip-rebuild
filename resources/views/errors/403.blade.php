@extends('errors::minimal')

@section('title', __('Forbidden Title'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden Message'))
