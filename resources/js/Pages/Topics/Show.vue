<script setup lang="ts">
import { ref } from 'vue'
import {Focused} from "@/Layouts";
import {
  ChatBubbleLeftIcon,
  HashtagIcon,
} from '@heroicons/vue/20/solid'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import {Topic} from "@/types";
import { XMarkIcon } from '@heroicons/vue/24/outline'
import {useForm, usePage} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import {DiscussionCard} from "@/Components/UI";

const page = usePage().props

const props = defineProps<{
  topic: Topic;
}>();

const form = useForm({
  title: '',
  topic: props.topic.id
})

const submit = async () => {
  form.post(route('discussions:store'), {
    preserveState: false,
    preserveScroll: true,
  });
}

const open = ref(false)
</script>

<template>
  <Focused>
    <template #default>
      <div class="lg:flex lg:items-center lg:justify-between">
        <div class="min-w-0 flex-1">
          <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
            {{ props.topic.title }}
          </h2>
          <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
            <div class="mt-2 flex items-center text-sm text-gray-500">
              <HashtagIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
              {{ props.topic.discussions.length }} Discussions for topic.
            </div>
          </div>
        </div>
        <div v-if="page.auth.user" class="mt-5 flex lg:ml-4 lg:mt-0">
          <span class="sm:ml-3">
            <button v-on:click.prevent="open = ! open" type="button" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
              <ChatBubbleLeftIcon class="-ml-0.5 mr-1.5 h-5 w-5" aria-hidden="true" />
              Join the Discussion
            </button>
          </span>
        </div>
      </div>

      <div class="space-y-6">

        <h1 class="sr-only">Recent discussions</h1>
        <ul role="list" class="space-y-4">
          <li v-for="item in props.topic.discussions" :key="item.id" class="bg-white px-4 py-6 shadow sm:rounded-lg sm:p-6">
            <DiscussionCard :discussion="item"/>
          </li>
        </ul>
      </div>
    </template>

    <template #slideover>
      <TransitionRoot as="template" :show="open">
        <Dialog as="div" class="relative z-10" @close="open = false">
          <div class="fixed inset-0" />

          <div class="fixed inset-0 overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">
              <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
                <TransitionChild as="template" enter="transform transition ease-in-out duration-500 sm:duration-700" enter-from="translate-x-full" enter-to="translate-x-0" leave="transform transition ease-in-out duration-500 sm:duration-700" leave-from="translate-x-0" leave-to="translate-x-full">
                  <DialogPanel class="pointer-events-auto w-screen max-w-2xl">
                    <form v-on:submit.prevent="submit" class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                      <div class="flex-1">
                        <!-- Header -->
                        <div class="bg-gray-50 px-4 py-6 sm:px-6">
                          <div class="flex items-start justify-between space-x-3">
                            <div class="space-y-1">
                              <DialogTitle class="text-base font-semibold leading-6 text-gray-900">
                                Add discussion to {{ topic.title }}
                              </DialogTitle>
                              <p class="text-sm text-gray-500">
                                Keep the conversation going by adding your discussion below.
                              </p>
                            </div>
                            <div class="flex h-7 items-center">
                              <button type="button" class="relative text-gray-400 hover:text-gray-500" @click="open = false">
                                <span class="absolute -inset-2.5" />
                                <span class="sr-only">Close panel</span>
                                <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                              </button>
                            </div>
                          </div>
                        </div>

                        <div class="space-y-6 py-6 sm:space-y-0 sm:divide-y sm:divide-gray-200 sm:py-0">
                          <div class="space-y-2 px-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5">
                            <div>
                              <InputLabel for="title" value="Discussion Title"/>
                            </div>
                            <div class="sm:col-span-2">
                              <TextInput
                                  v-model="form.title"
                                  name="title"
                                  id="title"
                                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                  placeholder="Start a discussion..."
                              />

                              <InputError class="mt-2" :message="form.errors.title"/>
                            </div>
                          </div>

                        </div>
                      </div>

                      <div class="flex-shrink-0 border-t border-gray-200 px-4 py-5 sm:px-6">
                        <div class="flex justify-end space-x-3">
                          <button type="submit" class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create</button>
                        </div>
                      </div>
                    </form>
                  </DialogPanel>
                </TransitionChild>
              </div>
            </div>
          </div>
        </Dialog>
      </TransitionRoot>
    </template>

  </Focused>
</template>
