<script setup lang="ts">
import { ref } from 'vue'
import {
  FaceFrownIcon,
  FaceSmileIcon,
  FireIcon,
  HandThumbUpIcon,
  HeartIcon,
  XMarkIcon,
  TagIcon,
} from '@heroicons/vue/20/solid'
import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue'
import {useForm, usePage} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";

const user = usePage().props.auth.user
const topics = usePage().props.topics

const form = useForm({
  title: '',
  topic: ''
})

const submit = async () => {
  form.post(route('discussions:store'), {
    preserveState: false,
    preserveScroll: true
  })
}

const moods = [
  { name: 'Excited', value: 'excited', icon: FireIcon, iconColor: 'text-white', bgColor: 'bg-red-500' },
  { name: 'Loved', value: 'loved', icon: HeartIcon, iconColor: 'text-white', bgColor: 'bg-pink-400' },
  { name: 'Happy', value: 'happy', icon: FaceSmileIcon, iconColor: 'text-white', bgColor: 'bg-green-400' },
  { name: 'Sad', value: 'sad', icon: FaceFrownIcon, iconColor: 'text-white', bgColor: 'bg-yellow-400' },
  { name: 'Thumbsy', value: 'thumbsy', icon: HandThumbUpIcon, iconColor: 'text-white', bgColor: 'bg-blue-500' },
  { name: 'I feel nothing', value: null, icon: XMarkIcon, iconColor: 'text-gray-400', bgColor: 'bg-transparent' },
]
</script>

<template>
  <div class="flex items-start space-x-4">
    <div class="flex-shrink-0">
      <img class="inline-block h-10 w-10 rounded-full" :src="user.avatar" :alt="`Avatar of ${user.name}`" />
    </div>
    <div class="min-w-0 flex-1">
      <form v-on:submit.prevent="submit" class="relative">
        <div class="overflow-hidden rounded-lg shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-indigo-600">
          <label for="title" class="sr-only">Start a discussion.</label>
          <textarea
              v-model="form.title"
              rows="3"
              name="title"
              id="title"
              class="block w-full resize-none border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
              placeholder="Start a discussion..."
          />

          <InputError class="mt-2" :message="form.errors.title"/>

          <div class="py-2" aria-hidden="true">
            <div class="py-px">
              <div class="h-9" />
            </div>
          </div>
        </div>

        <div class="absolute inset-x-0 bottom-0 flex justify-between py-2 pl-3 pr-2">
          <div class="flex items-center space-x-5">
            <div class="flex items-center">
              <Listbox as="div" v-model="form.topic">
                <ListboxLabel class="sr-only">Topic</ListboxLabel>
                <div class="relative">
                  <ListboxButton class="relative -m-2.5 flex h-10 w-10 items-center justify-center rounded-full text-gray-400 hover:text-gray-500">
                    <span class="ml-8 space-x-4 flex items-center justify-center">
                      <span>
                        <TagIcon class="h-5 w-5 flex-shrink-0" aria-hidden="true" />
                        <span class="sr-only">Attach a topic</span>
                      </span>
                      <span v-if="form.topic">
                        {{ topics.filter((topic) => topic.id === form.topic)[0].title }}
                      </span>
                    </span>
                  </ListboxButton>

                  <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">
                    <ListboxOptions class="absolute z-10 -ml-6 mt-1 w-60 rounded-lg bg-white py-3 text-base shadow ring-1 ring-black ring-opacity-5 focus:outline-none sm:ml-auto sm:w-64 sm:text-sm">
                      <ListboxOption as="template" v-for="topic in topics" :key="topic.id" :value="topic.id" v-slot="{ active }">
                        <li :class="[active ? 'bg-gray-100' : 'bg-white', 'relative cursor-default select-none px-3 py-2']">
                          <span class="ml-3 block truncate font-medium">{{ topic.title }}</span>
                        </li>
                      </ListboxOption>
                    </ListboxOptions>
                  </transition>
                </div>
              </Listbox>
            </div>

            <InputError class="mt-2" :message="form.errors.topic"/>
          </div>
          <div class="flex-shrink-0">
            <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Post</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>
