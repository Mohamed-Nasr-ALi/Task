import Dashboard from './components/admin/DashboardComponent.vue'
import Projects from './components/admin/ProjectComponent.vue'
import Tasks from './components/admin/TaskComponent.vue'

export const routes = [
    {
        path:'/dashboard',
        component:Dashboard
    },
    {
        path:'/projects',
        component:Projects
    },
    {
        path:'/tasks',
        component:Tasks
    },


];
