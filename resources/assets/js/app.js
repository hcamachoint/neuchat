
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.use(require('vue-chat-scroll'));
Vue.use(require('vue-chartist'),{
    messageNoData: "You have not enough data",
    classNoData: "empty"
});
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('chat-message', require('./components/ChatMessage.vue'));
Vue.component('chat-log', require('./components/ChatLog.vue'));
Vue.component('user-log', require('./components/UserLog.vue'));
Vue.component('chat-composer', require('./components/ChatComposer.vue'));
Vue.component('dashboard', require('./components/Dashboard.vue'));
Vue.component('notification', require('./components/Notification.vue'));
/*Vue.component('notification-item', require('./components/NotificationItem.vue'));*/
Vue.component('layout', require('./components/Layout.vue'));
Vue.component('example', require('./components/Example.vue'));

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

const app = new Vue({
    el: '#app', //NOMBRE QUE DEBE TENER LA APP <div id="app">
    data: {
        messages:[],
        userInRoom:'',
        information:'',
        users:[],
        userId:'',
        url:$("#base_url").val()
        },
    methods: {
        /**
         * add message
         * @param array
         */
        addMessage(message) {
            // add message to existing messages
            this.messages.push(message);

            // scroll to bottom after new message added
            this.$nextTick(() => {
                this.scrollToEnd();
            })
        },
        /**
         * to scroll page to end
         * @return void
         */
        scrollToEnd: function() {
            var container = document.querySelector("#content");
            var scrollHeight = container.scrollHeight;
            container.scrollTop = scrollHeight;
        },
        /**
         * get selected user with previous conversation
         * @param  array
         * @return void
         */
        getCurrentUser(user) {
            this.messages = "";
            this.userId = user.userId;
            axios.get(this.url+'/messages/'+this.userId).then( response=> {
                this.messages = response.data;
                // scroll to bottom after new message added
                this.$nextTick(() => {
                    this.scrollToEnd();
                });
            });

            var authId = $("#authId").val();
            var privateId = this.userId+authId; // unique id for private chat
            // laravel echo to send message to other ends (i.e who join given chatroom)
            Echo.private('chatroom.'+privateId)
            .listen('ChatMessage',(e)=>{
                this.messages.push({
                    message:e.message.message,
                    user:e.user.name,
                    time:e.message.created_at,
                    image_path:e.user.image_path,
                    type:e.message.type,
                    file_path:e.message.file_path,
                    file_name:e.message.file_name
                });

                // scroll to bottom after new message added
                this.$nextTick(() => {
                    this.scrollToEnd();
                });
            });

        }
    },
    updated() {
        this.scrollToEnd();
    }
});
