import {
    ApolloClient,
    createHttpLink,
    InMemoryCache,
    ApolloLink,
} from "@apollo/client/core";
import { DefaultApolloClient } from "@vue/apollo-composable";
import Pusher from "pusher-js";

export default defineNuxtPlugin((nuxtApp) => {
    const httpLink = createHttpLink({
        uri: "http://localhost:8000/graphql",
    });

    const pusher = new Pusher("11265415215f8de2660f", {
        cluster: "ap1",
    });

    // const pusherLink = new ApolloLink((operation, forward) => {
    //     const channel = pusher.subscribe("graphql-channel");

    //     channel.bind("graphql-event", (data) => {
    //         operation.setContext({ data });
    //     });

    //     return forward;
    // });

    const cache = new InMemoryCache();

    const apolloClient = new ApolloClient({
        link: httpLink,
        cache,
    });

    nuxtApp.vueApp.provide(DefaultApolloClient, apolloClient);
});
