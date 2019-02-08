<template>
    <div class="card">
        <div class="card-header">Sessions</div>
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Daytime</th>
                    <th>Length</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Screen Time</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="session in sessions">
                    <td>
                        <a :href="'/sessions/' + session.id">{{ session.date.format('MM/DD/YYYY') }}</a>
                    </td>
                    <td>{{ session.daytime.name }}</td>
                    <td>{{ session.length }}</td>
                    <td>{{ session.start }}</td>
                    <td>{{ session.end }}</td>
                    <td>{{ session.screen_time }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                sessions: []
            }
        },
        created() {
            axios.get('/api/sessions')
                .then(response => {
                    this.sessions = response.data.sessions;
                    this.parseSessionDates();
                })
                .catch(error => {
                    console.log(error);
                });
        },
        methods: {
            parseSessionDates() {
                this.sessions.map(function (session) {
                    session.date = moment(session.date);
                });
            }
        }
    }
</script>
