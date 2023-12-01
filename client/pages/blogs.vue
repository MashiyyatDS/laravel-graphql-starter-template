<template>
    <div>
        <h1>{{ loading ? "Loading..." : "Blogs" }}</h1>

        <div class="pagination">
            <button
                :disabled="pagination?.currentPage === 1"
                @click="variables.page -= 1"
            >
                Previous
            </button>
            <button
                :disabled="pagination?.currentPage === page"
                v-for="page in pagination?.lastPage"
                :key="page"
                @click="variables.page = page"
            >
                {{ page }}
            </button>
            <button
                :disabled="!pagination?.hasMorePages"
                @click="variables.page += 1"
            >
                Next
            </button>
        </div>

        <ul v-for="(blog, index) in blogs" :key="index">
            <li>{{ blog.id }}</li>
            <li>{{ blog.title }}</li>
            <li>{{ blog.content }}</li>
            <li>{{ blog.created_at }}</li>
            <li>{{ blog.updated_at }}</li>
            <li><button @click="editBlog(blog)">Edit</button></li>
            <li><button @click="deleteBlog(blog)">Delete</button></li>
        </ul>
    </div>
</template>

<script setup lang="ts">
import { useQuery } from "@vue/apollo-composable";
import { gql } from "graphql-tag";

type Blog = {
    id: string;
    title: string;
    content: string;
    created_at: string;
    updated_at: string;
};

type PaginatorInfo = {
    count: number;
    currentPage: number;
    firstItem: number;
    hasMorePages: boolean;
    lastItem: number;
    lastPage: number;
    perPage: number;
    total: number;
};

const fields = ["id", "title", "content", "created_at", "updated_at"];

const PAGINATE_BLOG = gql`
    query paginateBlog($first: Int!, $page: Int!) {
        paginateBlog(first: $first, page: $page) {
            data {
                ${fields.join(", ")}
            }

            paginatorInfo {
                count
                currentPage
                firstItem
                hasMorePages
                lastItem
                lastPage
                perPage
                total
            }
        }
    }
`;

const variables = reactive({
    first: 5,
    page: 1,
});

const { result, loading } = useQuery<{
    paginateBlog: { data: Blog[]; paginatorInfo: PaginatorInfo };
}>(PAGINATE_BLOG, variables);

const blogs = computed(() => result?.value?.paginateBlog?.data);

const pagination = computed(() => result?.value?.paginateBlog?.paginatorInfo);

const editBlog = <T>(blog: T) => {
    console.log(blog);
};

const deleteBlog = <T>(blog: T) => {
    console.log(blog);
};
</script>
