<template>
    <table class="table table-bordered">
        <tr class="text-muted"><th colspan="2">Activities</th></tr>
        <tr v-for="activity in activities" v-if="activity.percent > 0">
            <td class="text-muted">{{ activity.name }}</td>
            <td align="right">{{ activity.total }} ({{ activity.percent }}%)</td>
        </tr>
    </table>
</template>

<script>
    export default {
        data() {
            return {
                activities: [],
            }
        },
        created() {
            this.getActivities();
        },
        methods: {
            getActivities() {
                axios.get(`/api/activities/${this.date}`)
                .then(response => {
                    this.activities = response.data;
                })
                .catch(e => {
                    console.log(e);
                })
            }
        },
        props: ['date']
    }
</script>
