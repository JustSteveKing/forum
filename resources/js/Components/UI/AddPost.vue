<script setup lang="ts">
import {useForm, usePage} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";

const user = usePage().props.auth.user

const props = defineProps<{
  discussion: string;
}>();

const form = useForm({
  content: '',
})

const submit = async () => {
  form.post(route('discussions:posts:store', props.discussion), {
    preserveState: false,
    preserveScroll: true
  })
}
</script>

<template>
  <div class="flex items-start space-x-4">
    <div class="min-w-0 flex-1">
      <form v-on:submit.prevent="submit" class="relative">
        <div class="overflow-hidden rounded-lg shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-indigo-600">
          <label for="content" class="sr-only">Add your thoughts.</label>
          <textarea
              v-model="form.content"
              rows="3"
              name="content"
              id="content"
              class="block w-full resize-none border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
              placeholder="Add your thoughts..."
          />

          <InputError class="mt-2" :message="form.errors.content"/>

          <div class="py-2" aria-hidden="true">
            <div class="py-px">
              <div class="h-9" />
            </div>
          </div>
        </div>

        <div class="absolute inset-x-0 bottom-0 flex justify-between py-2 pl-3 pr-2">
          <div class="flex-shrink-0">
            <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Post</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>
