@props([
    'header' => ' ',

])

<div class="flex flex-col">
  <div class="-m-1.5 overflow-x-auto">
    <div class="p-1.5 min-w-full inline-block align-middle">
      <div class="overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
          <thead>
            <tr>
                {{ $header }}
                <!-- <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">{{ $header }}</th> -->
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                {{ $slot }}
                <!-- <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $slot }}</td> -->
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
    document.querySelectorAll('th').forEach(el=>el.classList.add("px-6" , "py-3", "text-start",
    "text-sm", "font-medium", "text-gray-500", "uppercase"));
    document.querySelectorAll('td').forEach(el=>el.classList.add("px-6", "py-4", 'whitespace-nowrap',
    "text-sm", "font-medium", "text-gray-800", 'dark:text-gray-200'));
</script>