<template>
    <div class="card">
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="start">Start Date</label>
                    <input type="date" class="form-control" name="start" v-model="start">
                </div>
                <div class="form-group">
                    <label for="start">End Date</label>
                    <input type="date" class="form-control" name="end" v-model="end">
                </div>
                <button class="btn btn-light" @click.prevent="getActivities">Submit</button>
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
                start: '2019-04-16',
                end: '2019-04-22',
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
