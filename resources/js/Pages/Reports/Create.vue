<script setup lang="ts">
import {Focused} from "@/Layouts";
import {useForm} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";

const props = defineProps<{
  instance: Object;
  model: string;
  identifier: string;
  reasons: [];
}>()

const form = useForm({
  reason: '',
  content: '',
  reportable_id: props.identifier,
  reportable_type: props.model,
  anonymous: false,
})

const submit = async () => {
  form.post(route('reports:store'), {
    preserveState: false,
    preserveScroll: true
  })
}
</script>

<template>
  <Focused>
    <div class="container mx-auto max-w-7xl">
      <div class="space-y-10 divide-y divide-gray-900/10">
        <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
          <div class="px-4 sm:px-0">
            <h2 class="text-base font-semibold leading-7 text-gray-900">
              Report Content
            </h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">
              Please use this form to report some content that you feel does not belong on this platform.
            </p>
          </div>

          <form method="POST" v-on:submit.prevent="submit" class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
            <div class="px-4 py-6 sm:p-8">
              <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                <div class="col-span-full">
                  <label for="content" class="block text-sm font-medium leading-6 text-gray-900">
                    Please explain
                  </label>
                  <div class="mt-2">
                    <textarea v-model="form.content" id="content" name="content" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                  </div>
                  <InputError class="mt-2" :message="form.errors.content"/>
                  <p class="mt-3 text-sm leading-6 text-gray-600">
                    Please write at least one sentence so we can understand your point of view for reporting this content.
                  </p>
                </div>

                <div class="col-span-full grid grid-cols-1 gap-x-6 ga-y-8 sm:grid-cols-6">
                  <div class="col-span-3">
                    <label for="reason" class="block text-sm font-medium leading-6 text-gray-900">
                      Reason for report
                    </label>
                    <div class="mt-2">
                      <select v-model="form.reason" id="reason" name="reason" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                        <option v-for="(reason, index) in props.reasons" :key="index" :value="reason">
                          {{ reason }}
                        </option>
                      </select>

                      <InputError class="mt-2" :message="form.errors.reason"/>
                    </div>
                  </div>

                  <fieldset class="col-span-3">
                    <legend class="text-sm font-semibold leading-6 text-gray-900">
                      Anonymous
                    </legend>
                    <p class="mt-1 text-sm leading-6 text-gray-600">
                      Keep your report anonymous, so only you can see that you have reported it.
                    </p>
                    <div class="mt-6 space-y-6">
                      <div class="flex items-center gap-x-3">
                        <input v-model="form.anonymous" id="anonymous" name="anonymous" type="checkbox" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                        <label for="anonymous" class="block text-sm font-medium leading-6 text-gray-900">Keep my report anonymous</label>
                      </div>

                      <InputError class="mt-2" :message="form.errors.anonymous"/>
                    </div>
                  </fieldset>
                </div>


              </div>
            </div>
            <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
              <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Submit Report
              </button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </Focused>
</template>
