<template>
    <div class="user-log">
            <li v-for="user in users" :user="user"  v-bind:key="user.id" @click="activateUser(user)" :id="user.id">

                    <!--<div class="col-md-2">
                        {{ user.id }}
                    </div>-->
                    <div class="col-md-12">
                        <h4>{{ user.name }}</h4>
                    </div>

            </li>
            <li v-show="users.length === 0" disabled>No friends found</li>
    </div>
</template>

<script>
    export default {
        methods:{
            activateUser (selectedUser) {
                this.$emit('getcurrentuser',{
                    userId:selectedUser.id
                });

                // show chat conversation
                $(".activate-chat").show();
                $(".chat-info").hide();
                // to make clicked li active
                $(".user-log .active").removeClass("active");
                $("#"+selectedUser.id).addClass("active");
            }
        },
        data() {
            return {
                default_image:$("#default_image").val(),
                users:[],
                url:$("#base_url").val()
            }
        },
        mounted() {
            // get users lists in left sidebar
            axios.get(this.url+'/users/list/').then( response=> {
                this.users = response.data;
            });

        }
    }
</script>
