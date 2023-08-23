<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import {Post} from "@/types";

const props = defineProps<{
  post: Post;
}>()
</script>

<template>
  <article :aria-labelledby="'question-title-' + props.post.id">
    <Link href="/">
      <div class="flex space-x-3">
        <div class="flex-shrink-0">
          <img class="h-10 w-10 rounded-full" :src="props.post.user.avatar" alt=""/>
        </div>
        <div class="min-w-0 flex-1">
          <p class="text-sm font-medium text-gray-900">
            <a class="hover:underline">{{ props.post.user.name }}</a>
          </p>
          <p class="text-sm text-gray-500">
            <a class="hover:underline">
              <time :datetime="props.post.created.string">{{ props.post.created.human }}</time>
            </a>
          </p>
        </div>
      </div>
      <h2 :id="'question-title-' + props.post.id" class="mt-4 text-base font-medium text-gray-900">
        {{ props.post.content }}
      </h2>
    </Link>
  </article>
</template>
