<template>
    <div>
        <h1>Front End Page</h1>
    </div>
</template>

<script setup lang="ts">
import Pusher from "pusher-js";
import { gql } from "graphql-tag";
import { useQuery } from "@vue/apollo-composable";

const pusher = new Pusher("11265415215f8de2660f", {
    cluster: "ap1",
});

const channel = pusher.subscribe("my-channel");

const users = gql`
    query users {
        users {
            id
            first_name
            middle_name
            last_name
            created_at
            updated_at
        }
    }
`;

const { result } = useQuery(users);

watch(result, () => {
    if (result) {
        console.log(result.value);
    }
});
</script>
