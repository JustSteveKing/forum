<script setup lang="ts">
import {Link, usePage} from "@inertiajs/vue3";
import {Topic} from "@/types";

const topics = usePage().props.topics
</script>

<template>
  <nav aria-label="Sidebar" class="sticky top-4 divide-y divide-gray-300">
    <div class="space-y-1 pb-8">
      <p class="px-3 text-sm font-medium text-gray-500" id="communities-headline">
        Topics
      </p>
      <Link
          v-for="topic in topics"
          :key="topic.id"
          :href="route('topics:show', topic.slug)"
          :title="`View all topics about ${topic.title}`"
          class="group flex items-center rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900"
      >
        <span class="truncate">{{ topic.title }}</span>
      </Link>
    </div>
  </nav>
</template>
