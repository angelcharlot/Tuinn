<div class=" h-screen mx-auto p-10 w-11/12 bg-cool-gray-50 shadow-lg my-5  ">
    <div class="shadow-sm overflow-hidden my-8">
        <table class="border-collapse table-auto  w-full text-xs md:text-sm ">

                <tr class="h-4 md:h-16 bg-gradient-to-b from-gray-50 to-gray-200">
                    <th
                        class="border-b  font-medium  p-2 md:p-4 pl-8 pt-0 pb-3 text-slate-400  text-left truncate">
                        id
                    </th>
                    <th
                        class="border-b  font-medium hidden md:block  p-2 md:p-4 pt-0 pb-3 text-slate-400  text-left truncate">
                        nombre
                    </th>
                    <th
                        class="border-b  font-medium  p-2 md:p-4 pr-8 pt-0 pb-3 text-slate-400  text-left truncate">
                        &euro;
                    </th>
                    <th
                        class="border-b  font-medium  p-2 md:p-4 pr-8 pt-0 pb-3 text-slate-400  text-left truncate">
                        categoria
                    </th>
                    <th
                    class="border-b  font-medium  p-2 md:p-4 pr-8 pt-0 pb-3 text-slate-400  text-left truncate">
                    categoria
                </th>
                    <th
                    class="border-b hidden md:block  font-medium  p-2 md:p-4 pr-8 pt-0 pb-3 text-slate-400  text-left truncate">
                    acciones
                    </th>

                </tr>
            <tbody class="bg-white dark:bg-slate-800">
                @foreach ($user->productos as $producto)

                    <tr>
                        <td
                            class="border-b border-slate-100  p-2 md:p-4 pl-8 text-slate-500 truncate">
                            {{$producto->id}}
                        </td>
                        <td
                            class="border-b hidden md:block border-slate-100  p-2 md:p-4 text-slate-500 truncate">
                            {{$producto->name}}
                        </td>
                        <td
                            class="border-b border-slate-100  p-2 md:p-4 pr-8 text-slate-500 truncate">
                            {{$producto->precio_venta}}
                        </td>
                        <td
                        class="border-b border-slate-100  p-2 md:p-4 pr-8 text-slate-500 truncate">
                        {{$producto->categoria->name}}
                        </td>
                        <td
                        class="border-b border-slate-100  p-2 md:p-4 pr-8 text-slate-500 truncate">
                        {{$producto->categoria->name}}
                        </td>
                        <td class="border-b hidden md:block border-slate-100  p-2 md:p-4 pr-8 text-slate-500 truncate">
                            acciones
                        </td>

                    </tr>
                    <tr class="visible md:hidden ">
                        <td class="border-b border-slate-100  p-2 md:p-4 text-slate-500" colspan="4" > {{$producto->name}}</td>
                    </tr>
                    <tr class="visible md:hidden ">
                        <td class="border-b border-slate-100  p-2 md:p-4 text-slate-500" colspan="4" > acciones</td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>





