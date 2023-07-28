@extends('errors::minimal')


@section('title', __('Server Error'))
@section('code', '401')
@section('message', $exception->getMessage())

