<template>
    <div class="card">
        <table class="table mb-0">
            <thead>
                <tr class="text-muted">
                    <th><a href="#" @click="sortByDate">DATE</a></th>
                    <th class="d-none d-md-table-cell"><a href="#" @click="sortByLength">LENGTH</a></th>
                    <th class="d-none d-md-table-cell"><a href="#" @click="sortByStart">START</a></th>
                    <th class="d-none d-md-table-cell"><a href="#" @click="sortByEnd">END</a></th>
                    <th class="d-none d-md-table-cell">SCREEN TIME</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="session in sessions">
                    <td>
                        <a :href="'/sessions/' + session.id">{{ session.date.format('MMM D, YYYY') }}</a>
                        <br>
                        <span class="text-muted" style="font-size:0.7rem">{{ session.date.format('dddd') }} <span class="text-lowercase">{{ session.daytime.name }}</span></span>
                    </td>
                    <td class="d-none d-md-table-cell">{{ session.lengthFormatted }}</td>
                    <td class="d-none d-md-table-cell">{{ session.start.format('h:mm a') }}</td>
                    <td class="d-none d-md-table-cell">{{ session.end.format('h:mm a') }}</td>
                    <td class="d-none d-md-table-cell">{{ session.screen_time }}</td>
                </tr>
            </tbody>
        </table>
        <div class="card-body">
            <div class="form">
                <button type="button" class="btn btn-outline-secondary" @click="decrementPage">Previous</button>
                <button type="button" class="btn btn-outline-secondary" @click="incrementPage">Next</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                sessions: [],
                sorters: {
                    length: 'longest',
                    date: 'oldest',
                    start: 'earliest',
                    end: 'earliest',
                },
                pageNumber: 1
            }
        },
        created() {
            this.getSessions();
        },
        methods: {
            getSessions() {
                axios.get(`/api/sessions/page/${this.pageNumber}`)
                    .then(response => {
                        this.sessions = response.data.sessions;
                        this.parseSessionDates();
                        this.parseSessionStarts();
                        this.parseSessionEnds();
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            parseSessionDates() {
                this.sessions.map(function (session) {
                    session.date = moment(session.start);
                });
            },
            parseSessionStarts() {
                this.sessions.map(function (session) {
                    session.start = moment(session.start);
                });
            },
            parseSessionEnds() {
                this.sessions.map(function (session) {
                    session.end = moment(session.end);
                });
            },
            sortByLength() {
                if (this.sorters.length === 'longest') {
                    this.sorters.length = 'shortest';
                    this.sessions.sort((a, b) => b.length > a.length);
                } else {
                    this.sorters.length = 'longest';
                    this.sessions.sort((a, b) => a.length > b.length);
                }
            },
            sortByDate() {
                if (this.sorters.date === 'newest') {
                    this.sorters.date = 'oldest';
                    this.sessions.sort((a, b) => b.date > a.date);
                } else {
                    this.sorters.date = 'newest';
                    this.sessions.sort((a, b) => a.date > b.date);
                }
            },
            sortByStart() {
                if (this.sorters.start === 'earliest') {
                    this.sorters.start = 'latest';
                    this.sessions.sort((a, b) => a.start.format('HH:mm') > b.start.format('HH:mm'));
                } else {
                    this.sorters.start = 'earliest';
                    this.sessions.sort((a, b) => b.start.format('HH:mm') > a.start.format('HH:mm'));
                }
            },
            sortByEnd() {
                if (this.sorters.end === 'earliest') {
                    this.sorters.end = 'latest';
                    this.sessions.sort((a, b) => a.end.format('HH:mm') > b.end.format('HH:mm'));
                } else {
                    this.sorters.end = 'earliest';
                    this.sessions.sort((a, b) => b.end.format('HH:mm') > a.end.format('HH:mm'));
                }
            },
            incrementPage() {
                this.pageNumber++;
                this.getSessions();
            },
            decrementPage() {
                if (this.pageNumber > 1) {
                    this.pageNumber--;
                }

                this.getSessions();
            }
        }
    }
</script>
