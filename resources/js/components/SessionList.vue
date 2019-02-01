<template>
    <div class="card">
        <div class="card-header">Sessions</div>
        <table class="table">
            <thead>
                <tr>
                    <th>Timeframe</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="session in sessions">
                    <td>
                        {{ session.date }}
                        <!-- <a href="/sessions/{{ session.id }}">{{ session.date }} {{ $session->startFormatted() }} - {{ $session->endFormatted() }}</a> -->
                    </td>
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
            let that = this;
            axios.get('/api/sessions')
                .then(function (response) {
                    that.sessions = response.data.sessions;
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    }
</script>
