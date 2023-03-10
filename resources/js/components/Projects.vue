<template>
    <div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-10">
                        <h4>Projects</h4>
                    </div>
                    <div class="col-2">
                        <div class="text-right">
                            <button type="button" class="btn btn-sm btn-success" @click.prevent="addProject">
                                Add project
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <table class="card-table table">
                <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Entries</th>
                        <th>Total time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="project in projectList" @repopulate="reRenderList()">
                        <td v-text="project.name"></td>
                        <td v-text="project.entries.length"></td>
                        <td>
                            {{ project.entries | totalTime }}
                        </td>
                        <td class="text-right">
                            <button type="button" class="btn btn-sm btn-dark" @click.prevent="editProject(project)">
                                Edit
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" @click.prevent="deleteProject(project)">
                                Delete
                            </button>
                            <a :href="`/projects/${project.id}`" class="btn btn-sm btn-secondary">Details</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <add-project ref="add"></add-project>
        <edit-project ref="edit"></edit-project>
    </div>
</template>

<script>
import AddProject from "./AddProject";
import EditProject from "./EditProject";
import { eventBus } from "../app";

export default {
    name: "Projects",
    components: {
        "add-project": AddProject,
        "edit-project": EditProject,
    },
    props: ["projects"],
    data: () => ({
        running: false,
        projectList: "",
    }),
    mounted() {
        this.projectList = this.$props.projects;
    },
    created() {
        eventBus.$on("project-created", (data) => {
            this.reRenderList();
        });
    },
    methods: {
        addProject() {
            this.$refs.add.open();
        },
        editProject(project) {
            this.$refs.edit.open(project);
        },
        deleteProject(project) {
            axios.delete(`/projects/${project.id}`);
            const projectIndex = this.projectList.indexOf(project);
            this.projects.splice(projectIndex, 1);
        },
        reRenderList() {
            axios
                .get(`/projects`)
                .then((response) => (this.projectList = response.data));
        },
    },
};
</script>
