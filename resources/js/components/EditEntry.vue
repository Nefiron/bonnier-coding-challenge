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
                        <label for="project_name">Task</label>
                        <input type="text" name="project_name" id="project_name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="project_name">Start Date</label>
                        <input type="text" name="project_name" id="project_name" class="form-control" v-model="entry.start" />
                    </div>
                    <div class="form-group">
                        <label for="project_name">End Date</label>
                        <input type="text" name="project_name" id="project_name" class="form-control" v-model="entry.end" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" @click.prevent="remove">Delete</button>
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
            axios.put(`/projects/${this.entry.project_id}/entries/${this.entry.id}`, {entry: this.entry});
            $(this.$refs.modal).modal('hide');
        },
        remove() {

        }
    }
}
</script>
