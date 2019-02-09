<template>
    <div class="card">
        <table class="table">
            <thead>
                <tr class="text-muted">
                    <th>DATE</th>
                    <th>LENGTH</th>
                    <th>START</th>
                    <th>END</th>
                    <th>SCREEN TIME</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="session in sessions">
                    <td>
                        <a :href="'/sessions/' + session.id">{{ session.date.format('MMM D, YYYY') }}</a>
                        <br>
                        <span class="text-muted" style="font-size:0.7rem">{{ session.date.format('dddd') }} <span class="text-lowercase">{{ session.daytime.name }}</span></span>
                    </td>
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
