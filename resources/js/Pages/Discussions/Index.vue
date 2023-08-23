<script setup lang="ts">
import {Application} from "@/Layouts";
import {usePage} from "@inertiajs/vue3";
import {Discussion} from "@/types";
import {
  DiscussionCard,
  StartDiscussion
} from "@/Components/UI";

import {
  HandThumbUpIcon,
} from '@heroicons/vue/24/outline'

const page = usePage().props

const props = defineProps<{
  discussions: Array<Discussion>;
}>();
</script>

<template>
  <Application>

    <template #sidenav>
      <nav aria-label="Sidebar" class="sticky top-4 divide-y divide-gray-300">
        <div class="space-y-1 pb-8">
          <p class="px-3 text-sm font-medium text-gray-500" id="communities-headline">
            Topics
          </p>
          <a v-for="topic in page.topics" :key="topic.id" :href="topic.slug"
             class="group flex items-center rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900">
            <span class="truncate">{{ topic.title }}</span>
          </a>
        </div>
      </nav>
    </template>

    <template #default>
      <div class="space-y-6">

        <template v-if="page.auth.user">
            <StartDiscussion />
        </template>

        <h1 class="sr-only">Recent discussions</h1>
        <ul role="list" class="space-y-4">
          <li v-for="item in props.discussions" :key="item.id" class="bg-white px-4 py-6 shadow sm:rounded-lg sm:p-6">
            <DiscussionCard :discussion="item" />
          </li>
        </ul>
      </div>
    </template>

    <template #sidebar>
      <div class="sticky top-4 space-y-4">
        <section aria-labelledby="trending-heading">
          <div class="rounded-lg bg-white shadow">
            <div class="p-6">
              <h2 id="trending-heading" class="text-base font-medium text-gray-900">Trending</h2>
              <div class="mt-6 flow-root">
                <ul role="list" class="-my-4 divide-y divide-gray-200">
                  <li v-for="discussion in page.trending" :key="discussion.id" class="flex space-x-3 py-4">
                    <div class="flex-shrink-0">
                      <img class="h-8 w-8 rounded-full" :src="discussion.user.avatar" :alt="discussion.user.name"/>
                    </div>
                    <div class="min-w-0 flex-1">
                      <p class="text-sm text-gray-800">{{ discussion.title }}</p>
                      <div class="mt-2 flex">
                        <span class="inline-flex items-center text-sm">
                          <button type="button" class="inline-flex space-x-2 text-gray-400 hover:text-gray-500">
                            <HandThumbUpIcon class="h-5 w-5" aria-hidden="true"/>
                            <span class="font-medium text-gray-900">{{ discussion.likes }}</span>
                          </button>
                        </span>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="mt-6">
                <a href="#" class="block w-full rounded-md bg-white px-3 py-2 text-center text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0">
                  View all
                </a>
              </div>
            </div>
          </div>
        </section>
      </div>
    </template>

  </Application>
</template>
