<script setup lang="ts">
import {
  ChatBubbleLeftEllipsisIcon,
  EyeIcon,
  HandThumbUpIcon,
} from "@heroicons/vue/24/outline"
import {Discussion} from "@/types";
import { Link } from "@inertiajs/vue3";

const props = defineProps<{
  discussion: Discussion;
}>()
</script>

<template>
  <article :aria-labelledby="'question-title-' + props.discussion.id">
    <Link :href="route('discussions:show', props.discussion.id)">
      <div class="flex space-x-3">
        <div class="flex-shrink-0">
          <img class="h-10 w-10 rounded-full" :src="props.discussion.user.avatar" alt=""/>
        </div>
        <div class="min-w-0 flex-1">
          <p class="text-sm font-medium text-gray-900">
            <a class="hover:underline">{{ props.discussion.user.name }}</a>
          </p>
          <p class="text-sm text-gray-500">
            <a class="hover:underline">
              <time :datetime="props.discussion.created.string">{{ props.discussion.created.human }}</time>
            </a>
          </p>
        </div>
      </div>
      <h2 :id="'question-title-' + props.discussion.id" class="mt-4 text-base font-medium text-gray-900">
        {{ props.discussion.title }}
      </h2>
    </Link>
    <div class="mt-6 flex justify-between space-x-8">
      <div class="flex space-x-6">
        <span class="inline-flex items-center text-sm">
          <button type="button" class="inline-flex space-x-2 text-gray-400 hover:text-gray-500">
            <HandThumbUpIcon class="h-5 w-5" aria-hidden="true"/>
            <span class="font-medium text-gray-900">{{ props.discussion.likes }}</span>
            <span class="sr-only">likes</span>
          </button>
        </span>
        <span class="inline-flex items-center text-sm">
          <button type="button" class="inline-flex space-x-2 text-gray-400 hover:text-gray-500">
            <ChatBubbleLeftEllipsisIcon class="h-5 w-5" aria-hidden="true"/>
            <span class="font-medium text-gray-900">{{ props.discussion.posts.length }}</span>
            <span class="sr-only">replies</span>
          </button>
        </span>
        <span class="inline-flex items-center text-sm">
          <button type="button" class="inline-flex space-x-2 text-gray-400 hover:text-gray-500">
            <EyeIcon class="h-5 w-5" aria-hidden="true"/>
            <span class="font-medium text-gray-900">{{ props.discussion.views }}</span>
            <span class="sr-only">views</span>
          </button>
        </span>
      </div>
    </div>
  </article>
</template>
