<script setup lang="ts">
import {Application} from "@/Layouts";
import {Discussion} from "@/types";
import {HandThumbUpIcon} from "@heroicons/vue/24/outline";
import {usePage} from "@inertiajs/vue3";
import {AddPost,DiscussionCard,PostCard,TopicSideBar} from "@/Components/UI";

const page = usePage().props

const props = defineProps<{
  discussion: Discussion;
}>();
</script>

<template>
  <Application>
    <template #sidenav>
      <TopicSideBar />
    </template>

    <template #default>
      <div class="space-y-6">

        <DiscussionCard :discussion="props.discussion" />


        <h1 class="sr-only">Recent discussions</h1>


        <ul role="list" class="space-y-4">
          <li v-if="page.auth.user">
            <AddPost :discussion="props.discussion.id" />
          </li>
          <li v-for="post in props.discussion.posts" :key="post.id" class="bg-white px-4 py-6 shadow sm:rounded-lg sm:p-6">
            <PostCard :post="post" />
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
