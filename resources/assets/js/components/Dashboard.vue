<!--https://github.com/Yopadd/vue-chartist-->
<template>
    <div class="row">
        <!--<p>{{users}}</p>-->
        <!--<ul v-if="users && users.length">
            <li v-for="user of users">
              <p><strong>{{user.name}}</strong></p>
              <p>{{user.email}}</p>
            </li>
          </ul>-->
        <!--<div class="col-md-6">
            <h1>G1</h1>
            <chartist
                ratio="ct-major-second"
                type="Line"
                :data="chart1"
                :options="charto1" >
            </chartist>
        </div>-->
        <div class="col-md-6">
            <h1>Registers</h1>
            <chartist
                ratio="ct-major-second"
                type="Bar"
                :data="chart2"
                :options="charto2" >
            </chartist>
        </div>
        <div class="col-md-6">
            <h1>Jobs</h1>
            <chartist
                class="chart"
                ratio="ct-major-second"
                type="Pie"
                :data="chart3"
                :options="charto3" >
            </chartist>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            users:[],
            url:$("#base_url").val(),
            chart1: {
                labels: ["A", "B", "C"],
                series:[[100, 120, 105]],
            },
            charto1: {
                lineSmooth: true
            },
            chart2: {
                labels: ["Users", "Admins", "Jobs"],
                series:[[this.users, 120, 105]],
            },
            charto2: {
                lineSmooth: true
            },
            chart3: {
                labels: ['News', 'Actives', 'Closed', 'Deletes'],
                series: [15, 40, 60, 100],
            },
            charto3: {
                lineSmooth: true,
                distributeSeries: true
            },
        }
    },
    
    mounted() {
        // get users lists in left sidebar
        axios.get('/panel/dashboard/').then( response=> {
            this.users = response.data;
        });
        console.log(this.users);
        console.log("Hola");
    }
}
</script>

<style>
    h1{
        color: black;
    }
</style>
