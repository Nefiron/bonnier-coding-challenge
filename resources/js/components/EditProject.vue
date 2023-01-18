<template>
    <div class="modal" tabindex="-1" role="dialog" ref="modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit {{ project.name }}</h5>
                    <button type="button" class="close" @click.prevent="closeModal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
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
                        <label for="project_name">Project name</label>
                        <input type="text" name="project_name" id="project_name" class="form-control"
                            v-model="project.name" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click.prevent="closeModal">Cancel</button>
                    <button type="button" class="btn btn-success" @click.prevent="submit">Save project</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        project: '',
        errors: '',
    }),
    methods: {
        open(project) {
            this.project = project
            $(this.$refs.modal).modal('show');
        },
        closeModal() {
            $(this.$refs.modal).modal('hide');
            this.project = ''
        },
        submit() {
            axios.put(`/projects/${this.project.id}`, this.project);
            $(this.$refs.modal).modal('hide');
        }
    }
}
</script>
