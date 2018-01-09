
<template>
    <a :href="threadUrl">
        <b>{{ unread.data.user.name }}</b> propose: <i>{{ unread.data.proposal.message }}</i>
    </a>
</template>

<script>
    export default {
        props:['unread'],
        data(){
            return {
                threadUrl:""
            }
        },
        mounted(){
            this.threadUrl="work/show/"+ this.unread.data.proposal.work_id
        }
    }
</script>