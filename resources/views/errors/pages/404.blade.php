@extends('errors.layout')

@section('errorCode', '404')
@section('errorTitle', __('errors.404_title'))
@section('errorMessage', __('errors.404_message'))
@section('errorBtnHome', true)
