@extends('errors.layout')

@section('title', __('errors.Not Found Title'))
@section('code', '404')
@section('message', $exception->getMessage()  ?? __('errors.Not Found Message'))
