<section class="section" id="kids">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2>Kid's Latest</h2>
                    <span>Details to details is what makes Hexashop different from the other themes.</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <div class="kid-item-carousel">
                    <div class="owl-kid-item owl-carousel">
                        @foreach ($productkids as $product)
                        <div class="item">
                            <div class="thumb">
                                <div class="hover-content">
                                    <ul>
                                        <li><a href="{{route('singleproduct',$product->id)}}"><i class="fa fa-eye"></i></a></li>
                                        <li><a href="{{route('singleproduct',$product->id)}}"><i class="fa fa-star"></i></a></li>
                                        <li><a href="{{route('singleproduct',$product->id)}}"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <img src="{{asset('assests/images/'.$product->image)}}" alt="">
                            </div>
                            <div class="down-content">
                                <h4>{{$product->name}}</h4>
                                <span>${{$product->price}}</span>
                                <ul class="stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                            </div>
                       
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{ $productkids->links('pagination::bootstrap-4') }}
    </div>
</section>
<script>
    const paginationContainer = document.querySelector('.pagination-container');
    const prevArrow = paginationContainer.querySelector('.prev-arrow');
    const nextArrow = paginationContainer.querySelector('.next-arrow');
    const paginationItems = paginationContainer.querySelector('.pagination-items');
    
    // Replace with your data
    const itemsPerPage = 3;
    const totalItems = $latestwomen->count();
    
    // Calculate the total number of pages
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    
    // Function to create pagination items
    function createPaginationItems() {
        for (let i = 1; i <= totalPages; i++) {
            const paginationItem = document.createElement('button');
            paginationItem.textContent = i;
            paginationItem.addEventListener('click', (event) => {
                const currentPage = parseInt(event.target.textContent);
                updatePagination(currentPage);
            });
            paginationItems.appendChild(paginationItem);
        }
    }
    
    // Function to update pagination based on the current page
    function updatePagination(currentPage) {
        // Adjust the display of pagination items based on the current page
        // ... (Your logic to display the appropriate items)
    
        // Update the "prev" and "next" arrow buttons
        prevArrow.disabled = currentPage === 1;
        nextArrow.disabled = currentPage === totalPages;
    }
    
    // Initial pagination setup
    createPaginationItems();
    updatePagination(1);
    
    // Event listeners for "prev" and "next" arrows
    prevArrow.addEventListener('click', () => {
        const currentPage = parseInt(paginationItems.querySelector('.active').textContent);
        updatePagination(currentPage - 1);
    });
    
    nextArrow.addEventListener('click', () => {
        const currentPage = parseInt(paginationItems.querySelector('.active').textContent);
        updatePagination(currentPage + 1);
    });
       </script>