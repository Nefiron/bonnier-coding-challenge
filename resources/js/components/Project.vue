<template>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h4 v-text="project.name"></h4>
                </div>
                <div class="col-2">
                    <div class="text-right">
                        <button v-show="running" type="button" class="btn btn-sm btn-danger" @click.prevent="stopTimer">Stop</button>
                        <button v-show="!running" type="button" class="btn btn-sm btn-success" @click.prevent="startTimer">Start</button>
                    </div>
                </div>
            </div>
        </div>
        <table class="card-table table">
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Start date</th>
                    <th>End date</th>
                    <th>Time spent</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <tr v-show="currentWorkingEntry" class="table-warning">
                    <td> {{ currentWorkingEntry.task }}</td>
                    <td> {{ currentWorkingEntry.start }}</td>
                    <td> {{ currentWorkingEntry.end }}</td>
                    <td>
                        {{ currentWorkingEntry.start | hoursBetweenDates(currentWorkingEntry.end) }}
                    </td>
                    <td><button v-show="running" type="button" class="btn btn-sm btn-danger" @click.prevent="stopTimer">Stop Current</button></td>
                </tr>
                <tr v-for="entry in entries">
                    <td> {{ entry.task }}</td>
                    <td> {{ entry.start }}</td>
                    <td> {{ entry.end }}</td>
                    <td>
                        {{ entry.start | hoursBetweenDates(entry.end) }}
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary" @click="editEntry(entry)">Edit</button>
                        <button class="btn btn-sm btn-danger" @click="deleteEntry(entry)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <edit-entry ref="edit"></edit-entry>
    </div>
</template>

<script>
import EditEntry from './EditEntry.vue';

export default {
    name: "Project",
    components: {
        'edit-entry': EditEntry
    },
    props: ['project'],
    data: () => ({
        running: false,
        currentWorkingEntry: '',
        entries: ''
    }),
    mounted() {
        this.entries = this.$props.project.entries
    },
    methods: {
        startTimer() {
            this.running = true;

            axios.post(`/projects/${this.$props.project.id}/entries/start`)
                .then(response => {
                    this.currentWorkingEntry = response.data
                })

        },
        stopTimer() {
            axios.put(`/projects/${this.$props.project.id}/entries/${this.currentWorkingEntry.id}/stop`)
                .then(response => {
                    this.entries = response.data
                    this.running = false;
                    this.currentWorkingEntry = ''
                })

        },
        editEntry(entry) {
            this.$refs.edit.open(entry);
        },
        deleteEntry(entry) {
            axios.delete(`/projects/${this.$props.project.id}/entries/${entry.id}`)
            const entryIndex = this.entries.indexOf(entry)
            this.entries.splice(entryIndex, 1)
        }
    }
}
</script>
