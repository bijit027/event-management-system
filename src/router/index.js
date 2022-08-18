import { createWebHashHistory, createRouter } from "vue-router";
import AllEvents from "../admin/pages/AllEvents.vue";
import AddEvent from "../admin/pages/AddEvent.vue";
import ViewEvent from "../admin/pages/ViewEvent.vue";
import EditEvent from "../admin/pages/EditEvent.vue";
import AddEventCategory from "../admin/pages/EventCategories.vue";
import EditEventCategory from "../admin/pages/EditEventCategory.vue";
import EventOrganizer from "../admin/pages/EventOrganizer.vue";
import EditEventOrganizer from "../admin/pages/EditEventOrganizer.vue";
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
    {
        path: "/eventCategory",
        name: "AddEventCategory",
        component: AddEventCategory,
    },
    {
        path: "/eventCategory/:eventID",
        name: "EditEventCategory",
        component: EditEventCategory,
    },
    {
        path: "/eventOrganizer",
        name: "EventOrganizer",
        component: EventOrganizer,
    },
    {
        path: "/eventOrganizer/:eventID",
        name: "EditEventOrganizer",
        component: EditEventOrganizer,
    },
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

export default router;
