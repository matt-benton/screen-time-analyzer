<template>
    <a :href="`/sessions/date/${ date.format('YYYY-MM-DD') }`">
        <div class="row text-info">
            <div class="col">
                <h5>{{ date.format('dddd, MMMM Do, YYYY') }}</h5>
            </div>
            <div class="col text-right">
                <h5>{{ totalScreenTime }} of screen time</h5>
            </div>
        </div>
    </a>
</template>

<script>
    export default {
        data() {
            return {
                date: moment(),
                totalScreenTime: '',
            }
        },
        created() {
            this.getTotalScreenTime();
        },
        methods: {
            getTotalScreenTime() {
                axios.get(`/api/sessions/${this.date.year()}/${this.date.month() + 1}/${this.date.date()}`)
                .then(response => {
                    this.totalScreenTime = response.data;
                })
                .catch(e => {
                    console.log(e);
                })
            }
        }
    }
</script>

<style>
    a:hover {
        text-decoration: none;
    }
</style>
