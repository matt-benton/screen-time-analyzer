<template>
    <div class="card">
        <div class="card-body">
            <form>
                <div class="form-row">
                    <div class="form-group mr-2">
                        <label for="start">Start Date</label>
                        <input type="date" class="form-control" name="start" v-model="start">
                    </div>
                    <div class="form-group mr-2">
                        <label for="start">End Date</label>
                        <input type="date" class="form-control" name="end" v-model="end">
                    </div>
                    <div class="form-group">
                        <label>&nbsp</label>
                        <button class="btn btn-light form-control" @click.prevent="getActivities">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <table class="table">
            <tr v-for="activity in activities">
                <td>{{ activity.name}}</td>
                <td>{{ activity.total }}</td>
                <td>{{ activity.percent }}</td>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                activities: [],
                start: moment().subtract(7, 'days').format('YYYY-MM-DD'),
                end: moment().format('YYYY-MM-DD'),
            }
        },
        created() {
            this.getActivities();
        },
        methods: {
            getActivities() {
                axios.post('/api/activities', {
                    start: this.start,
                    end: this.end
                })
                .then(response => {
                    this.activities = response.data;
                })
                .catch(e => {
                    console.log(e);
                });
            }
        }
    }
</script>
