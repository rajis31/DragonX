<template>
  <div
    class="bg-dark-purple h-screen p-5 pt-8 relative duration-300"
    :class="open ? 'w-72' : 'w-24'"
  >
    <img
      src="/control.png"
      class="
        absolute
        cursor-pointer
        -right-3
        top-9
        w-7
        border-dark-purple border-2
        rounded-full
      "
      :class="!open && 'rotate-180'"
      @click="open = !open"
    />

    <div class="flex gap-x-4 items-center">
      <font-awesome-icon
        icon="fa-solid fa-dragon"
        size="3x"
        class="cursor-pointer 
               duration-500"
        :class="open && 'rotate-[360deg]'"
      />
      <h1 
        class="
            text-white
            origin-left
            font-medium
            text-xl
            duration-200
        "
        :class="!open && 'scale-0'"
      >
        DragonX
      </h1>
    </div>
    <ul class="pt-6">
            <li
              class="flex 
                     rounded-md 
                     p-2 
                     cursor-pointer 
                     hover:bg-light-white 
                     text-gray-300 
                     text-sm 
                     items-center 
                     gap-x-4 
                     mt-5"
            >
              <font-awesome-icon icon="fa-solid fa-house" size="2x" />
              <span :class="!open && 'hidden'" class="origin-left duration-200">
                Home
              </span>
            </li>
             <li
              class="flex 
                     rounded-md 
                     p-2 
                     cursor-pointer 
                     hover:bg-light-white 
                     text-gray-300 
                     text-sm 
                     items-center 
                     gap-x-4 
                     mt-5"
            >
              <font-awesome-icon icon="fa-solid fa-flag" size="2x"/>
              <span :class="!open && 'hidden'" class="origin-left duration-200">
                Banner
              </span>
            </li>
             <li
              class="flex 
                     rounded-md 
                     p-2 
                     cursor-pointer 
                     hover:bg-light-white 
                     text-gray-300 
                     text-sm 
                     items-center 
                     gap-x-4 
                     mt-5"
            >
              <font-awesome-icon icon="fa-solid fa-shop" size="2x" />
              <span :class="!open && 'hidden'" class="origin-left duration-200">
                Shop Analytics
              </span>
            </li>
    
    </ul>

  </div>
</template>

<script>
export default {
  data() {
    return {
      open: true,
    }

  }
}
</script>

<style scoped>
</style>
