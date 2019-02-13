<template>
    <div class="card">
        <table class="table">
            <thead>
                <tr class="text-muted">
                    <th>DATE</th>
                    <th><a href="#" @click="sortByLength">LENGTH</a></th>
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
                    <td>{{ session.lengthFormatted }}</td>
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
                sessions: [],
                lengthSortDirection: 'asc',
            }
        },
        created() {
            this.getSessions();
        },
        methods: {
            getSessions() {
                axios.get('/api/sessions')
                    .then(response => {
                        this.sessions = this.parseSessionDates(response.data.sessions);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            parseSessionDates(sessions) {
                sessions.map(function (session) {
                    session.date = moment(session.date);
                });

                return sessions;
            },
            sortByLength() {
                if (this.lengthSortDirection === 'asc') {
                    this.lengthSortDirection = 'desc';
                    this.sessions.sort((a, b) => {
                        return b.length > a.length;
                    });
                } else {
                    this.lengthSortDirection = 'asc';
                    this.sessions.sort((a, b) => {
                        return a.length > b.length;
                    });
                }
            }
        }
    }
</script>
