<template>
    <div>
        <h1>Open AI</h1>
    </div>
</template>

<script setup lang="ts">
import OpenAI from "openai";

const openai = new OpenAI({
    apiKey: "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",
    dangerouslyAllowBrowser: true,
});

async function main() {
    const completion = await openai.chat.completions.create({
        messages: [{ role: "system", content: "You are a helpful assistant." }],
        model: "gpt-3.5-turbo",
    });

    console.log(completion.choices[0]);
}

main();

// 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
</script>
