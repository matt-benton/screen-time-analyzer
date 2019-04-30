<template>
    <div>
        <div class="col-md-12">
            <form>
                <div class="form-row">
                    <div class="form-group mr-2">
                        <label class="text-muted" for="start">Start Date</label>
                        <input type="date" class="form-control" name="start" v-model="start" @change="getActivities">
                    </div>
                    <div class="form-group mr-2">
                        <label class="text-muted" for="start">End Date</label>
                        <input type="date" class="form-control" name="end" v-model="end" @change="getActivities">
                    </div>
                </div>
            </form>
        </div>
        <table class="table table-striped mb-0">
            <thead>
                <tr class="text-muted text-uppercase">
                    <th>Activity</th>
                    <th>Average Per Day</th>
                    <th>Total</th>
                    <th>% of Total</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="activity in activities">
                    <td>{{ activity.name }}</td>
                    <td>{{ activity.average }}</td>
                    <td>{{ activity.total }}</td>
                    <td>{{ activity.percent }}%</td>
                </tr>
            </tbody>
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
