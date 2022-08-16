import { createWebHashHistory, createRouter } from "vue-router";
import AllEvents from "../admin/components/AllEvents.vue";
import AddEvent from "../admin/components/AddEvent.vue";
import ViewEvent from "../admin/components/ViewEvent.vue";
import EditEvent from "../admin/components/EditEvent.vue";
const routes = [
    {
        path: "/",
        name: "AllEvents",
        component: AllEvents,
    },
    {
        path: "/addEvent",
        name: "AddEvent",
        component: AddEvent,
    },
    {
        path: "/show-event/:eventID",
        name: "ViewEvent",
        component: ViewEvent,
    },
    {
        path: "/edit-event/:eventID",
        name: "EditEvent",
        component: EditEvent,
    },
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

export default router;
