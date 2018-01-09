@extends('layouts.message')

@section('content')

    <div id="wrapper">
        <div id="chatSection">
            <?php
                if(Auth::user()->image != 'null') {
                    $imageSrc = '/avatars/'.Auth::user()->picture;
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
                        <a href="/home">
                            Sublinkpro
                        </a>
                    </li>
                    <input type="text" class="form-control" placeholder="Search">
                    <user-log :users="users" v-on:getcurrentuser="getCurrentUser"></user-log>
                    <li class="logout">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            Logout <i class="fa fa-sign-out"></i>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="chat-info">
                                <h2><span class="label label-success">Live Chat</span></h2>
                                <p><span class="label label-default">Choose one of you partner from left sidebar to make a conversion.</span></p>
                            </div>
                            <div class="activate-chat">
                                <div class="header">

                                </div>
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