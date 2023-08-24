<script setup lang="ts">
import {
  ChatBubbleLeftEllipsisIcon,
  EyeIcon,
  HandThumbUpIcon,
} from "@heroicons/vue/24/outline"
import {Discussion} from "@/types";
import {Link} from "@inertiajs/vue3";
import {Menu, MenuButton, MenuItem, MenuItems} from '@headlessui/vue'
import {
  EllipsisVerticalIcon,
  FlagIcon,
} from '@heroicons/vue/20/solid'

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
        <div class="flex flex-shrink-0 self-center">
          <Menu as="div" class="relative inline-block text-left">
            <div>
              <MenuButton class="relative -m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600">
                <span class="absolute -inset-1"/>
                <span class="sr-only">Open options</span>
                <EllipsisVerticalIcon class="h-5 w-5" aria-hidden="true"/>
              </MenuButton>
            </div>

            <transition enter-active-class="transition ease-out duration-100"
                        enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100"
                        leave-active-class="transition ease-in duration-75"
                        leave-from-class="transform opacity-100 scale-100"
                        leave-to-class="transform opacity-0 scale-95">
              <MenuItems
                class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                <div class="py-1">
                  <MenuItem v-slot="{ active }">
                    <Link :href="route('reports:create', [props.discussion.id, 'discussion'])"
                       :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'flex px-4 py-2 text-sm']">
                      <FlagIcon class="mr-3 h-5 w-5 text-gray-400" aria-hidden="true"/>
                      <span>Report content</span>
                    </Link>
                  </MenuItem>
                </div>
              </MenuItems>
            </transition>
          </Menu>
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
