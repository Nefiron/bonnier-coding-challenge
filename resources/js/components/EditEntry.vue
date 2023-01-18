<template>
    <div class="modal" tabindex="-1" role="dialog" ref="modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Entry</h5>
                    <button type="button" class="close" @click.prevent="closeModal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div v-if="errors" class="alert alert-danger">
                        <div v-for="(v, k) in errors" :key="k">
                            <p v-for="error in v" :key="error">
                                {{ error }}
                            </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="entry_task">Task</label>
                        <input type="text" name="entry_task" id="entry_task" class="form-control" v-model="entry.task" />
                    </div>
                    <div class="form-group">
                        <label for="entry_start">Start Date</label>
                        <input type="text" name="entry_start" id="entry_start" class="form-control" v-model="entry.start" />
                    </div>
                    <div class="form-group">
                        <label for="entry_end">End Date</label>
                        <input type="text" name="entry_end" id="entry_end" class="form-control" v-model="entry.end" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click.prevent="closeModal">Cancel</button>
                    <button type="button" class="btn btn-success" @click.prevent="submit">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        entry: '',
        errors: null
    }),
    methods: {
        open(entry) {
            this.entry = entry
           $(this.$refs.modal).modal('show');
        },
        closeModal() {
            $(this.$refs.modal).modal('hide');
            this.entry = '';
        },
        submit() {
            axios.put(`/projects/${this.entry.project_id}/entries/${this.entry.id}`, this.entry)
            $(this.$refs.modal).modal('hide');
            this.entry = '';
        }
    }
}
</script>
