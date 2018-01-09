@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/simple-sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
@endsection

@section('content')

    <div id="wrapper">
        <div id="app">
            <?php
                if(Auth::user()->picture != 'null') {
                    $imageSrc = Auth::user()->image_path;
                } else {
                    $imageSrc = default_image;
                }
            ?>
            <input type="hidden" value="{{ Auth::user()->name }}" id="user_name">
            <input type="hidden" value="{{ Auth::user()->id }}" id="authId">
            <input type="hidden" value="{{ $imageSrc }}" id="default_image">
            <input type="hidden" value="{{ url('') }}" id="base_url">
            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li class="sidebar-brand">
                        <a href="#">
                            Messages
                        </a>
                    </li>
                    <input type="text" class="form-control" placeholder="Search">
                    <user-log :users="users" v-on:getcurrentuser="getCurrentUser"></user-log>
                </ul>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="chat-info">
                                <h2>Selecciona un contacto para empezar a conversar.</h2>
                            </div>
                            <div class="activate-chat">
                                <div id="content" class="scrollbar">
                                    <ul class="messages" v-chat-scroll>
                                        <chat-log :messages="messages"></chat-log>
                                    </ul>
                                </div>
                                <div class="footer">
                                    <chat-composer v-on:messagesent="addMessage" :user-id="userId"></chat-composer>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /#page-content-wrapper -->
        </div>
    </div>

    <!-- /#wrapper -->
@endsection
@section('footer')
<script src="js/sweetalert.min.js"></script>
<script src="js/moment.min.js"></script>
@endsection
