// # =================================================
// # bubble selector
// # =================================================
    const bubbles = document.querySelectorAll('.bubble');
    bubbles.forEach(bubble => {
        bubble.addEventListener("click", function() {
            this.querySelector('.inner-bubble').classList.toggle('default-bg-color');
            // find, collect, and set bubble IDs  
            const activeBubbles = this.closest('.slider-container').querySelectorAll('.inner-bubble.default-bg-color');
            const activeBubblesIds = [];
            activeBubbles.forEach(element => {
                activeBubblesIds.push(element.dataset.id);
            });
            // set input
            this.closest('.slider-container').querySelector('input.id-collector').value = activeBubblesIds.join();
            // check to see if we should set a counter
            const idCollectorCount = this.closest('.filter-set').querySelector('.id-collector-count');
            if (idCollectorCount) {
                idCollectorCount.textContent = activeBubblesIds.length > 0 ? activeBubblesIds.length : '';
            }
        });
    });

// # =================================================
// # filter sliders
// # =================================================
    // show hide search 
    const searchIconBtns = document.querySelectorAll('.search-icon-btn');
    searchIconBtns.forEach(searchIconBtn => {
        searchIconBtn.addEventListener("click", function() {
            // check to see what were targeting
            const target = this.dataset.target;
            // check to see what state we are in
            if (this.classList.contains('fa-search')) {
                this.classList.remove('fa-search');
                this.classList.add('fa-search-minus');
                document.querySelector('#' + target + ' .filter-bubbles-container').classList.toggle('open');
                const searchFilter = document.querySelector('#' + target + ' .filter-search');
                searchFilter.classList.toggle('hide-so');
                searchFilter.focus();
            } else {
                this.classList.remove('fa-search-minus');
                this.classList.add('fa-search');
                const searchFilter = document.querySelector('#' + target + ' .filter-search');
                searchFilter.classList.toggle('hide-so');
                searchFilter.value = '';
                searchFilter.click();
                const searchFilters = [searchFilter];
                searchFilters.forEach(function(e) {
                    const textToFilter = e.value.toLowerCase();
                    const bubbles = e.closest('.slider-container').querySelectorAll('.bubble-container');
                    bubbles.forEach(bubble => {
                        bubble.classList.remove('hide');
                    });
                    bubbles.forEach(bubble => {
                        const bubbleText = bubble.dataset.filtertext.toLowerCase();
                        if (!(bubbleText.includes(textToFilter))) {
                            bubble.classList.add('hide');
                        }
                    });
                });
                document.querySelector('#' + target + ' .filter-bubbles-container').classList.toggle('open');
            }
        });
    });

    searchFilterFunc = function() {
        const textToFilter = this.value.toLowerCase();
        const bubbles = this.closest('.slider-container').querySelectorAll('.bubble-container');
        bubbles.forEach(bubble => {
            bubble.classList.remove('hide');
        });
        bubbles.forEach(bubble => {
            const bubbleText = bubble.dataset.filtertext.toLowerCase();
            if (!(bubbleText.includes(textToFilter))) {
                bubble.classList.add('hide');
            }
        });
    };

    // filter bubbles in siders
    const searchFilters = document.querySelectorAll('.filter-search');
    searchFilters.forEach(searchFilter => {
        searchFilter.addEventListener("input", searchFilterFunc);
    });
    

// # =================================================
// # side bar nav
// # =================================================

    // side bar function
    sideBar = function() {
        // toggle sidebar
        const sideBar = document.querySelector('.side-bar-menu');
        sideBar.classList.toggle('open');
        // toggle icon animation
        const sideBarIcon = document.querySelector('.side-bar-menu-icon');
        sideBarIcon.classList.toggle('menu-stage-3');
        // work with sidebar and modal
        const sideBarModal = document.querySelector('.side-bar-modal');
        if (sideBarModal.classList.contains('open')) {
            // closes sidebar
            sideBarModal.classList.toggle('open');
            // closes modal, makes modal disappear so we can touch elements beyond it
            setTimeout(function(){ sideBarModal.classList.toggle('appear'); }, 400);
        } else {
            // open modal
            sideBarModal.classList.toggle('appear');
            sideBarModal.classList.toggle('open');
        }
    }
    // side bar function click handlers
    const sidebar = document.querySelector('.side-bar-menu-icon');
    if (sidebar) {
        document.querySelector('.side-bar-menu-icon').addEventListener("click", sideBar);
        document.querySelector('.side-bar-modal').addEventListener("click", sideBar);
    }

// # =================================================
// # side bar filter
// # =================================================
    // side bar filter function
    sideBarFilter = function() {
        // toggle sidebar filter
        const sideBarFilter = document.querySelector('.side-bar-filter');
        sideBarFilter.classList.toggle('open');
        // work with modal
        const sideBarFilterModal = document.querySelector('.side-bar-filter-modal');
        if (sideBarFilterModal.classList.contains('open')) {
            // closes sidebar
            sideBarFilterModal.classList.toggle('open');
            // closes modal, makes modal disappear so we can touch elements beyond it
            setTimeout(function(){ sideBarFilterModal.classList.toggle('appear'); }, 400);
        } else {
            // open modal
            sideBarFilterModal.classList.toggle('appear');
            sideBarFilterModal.classList.toggle('open');
        }
    }

    // side bar function click handlers
    const sidebarFilter = document.querySelector('.filter-icon');
    if (sidebarFilter) {
        document.querySelector('.filter-icon-container').addEventListener("click", sideBarFilter);
        document.querySelector('.side-bar-filter-modal').addEventListener("click", sideBarFilter);
        document.querySelector('.filter-options .fa-long-arrow-right').addEventListener("click", sideBarFilter);
        // check box activate icon
        const checkBoxes = document.querySelectorAll('.sort-by-item label');
        checkBoxes.forEach(element => {
            element.addEventListener("click", function() {
                this.closest('.sort-by-item').querySelector('.sort-icon').classList.toggle('hide-o')   
            });
        });
        // switch icon on click
        const sortIcons = document.querySelectorAll('.sort-by-item .sort-icon');
        sortIcons.forEach(element => {
            element.addEventListener("click", function() {
                if (this.classList.contains('fa-sort-alpha-down')) {
                    this.classList.remove('fa-sort-alpha-down');
                    this.classList.add('fa-sort-alpha-down-alt');
                } else if (this.classList.contains('fa-sort-alpha-down-alt')) {
                    this.classList.remove('fa-sort-alpha-down-alt');
                    this.classList.add('fa-sort-alpha-down');
                } else if (this.classList.contains('fa-sort-numeric-down')) {
                    this.classList.remove('fa-sort-numeric-down');
                    this.classList.add('fa-sort-numeric-down-alt');
                } else if (this.classList.contains('fa-sort-numeric-down-alt')) {
                    this.classList.remove('fa-sort-numeric-down-alt');
                    this.classList.add('fa-sort-numeric-down');
                } 
            });
        });
        // filter by stars
        const stars = document.querySelectorAll('.filter-by-stars .fa-star');
        stars.forEach(element => {
            element.addEventListener("click", function() {
                const starCount = this.dataset.stars;
                const stars = document.querySelectorAll('.filter-by-stars .fa-star');
                stars.forEach(e => {
                    e.classList.remove('default-color');
                });
                for (let i = 0; i < starCount; i++) {
                    stars[i].classList.add('default-color');
                }
                // set input
                document.querySelector('.filter-by-stars input').value = starCount;
            });
        });
        // reset form button
        document.querySelector('.filter-options .fa-redo').addEventListener("click",function() {
            // reset all checkboxes
            const checkedCheckBoxes = document.querySelectorAll('.sort-by-item input[type="checkbox"]:checked');
            checkedCheckBoxes.forEach(element => {
                element.closest('div').querySelector('label').click();
            });
            const stars = document.querySelectorAll('.filter-by-stars .fa-star');
            stars.forEach(element => {
                element.classList.remove('default-color');
            });
            // set input
            document.querySelector('.filter-by-stars input').value = 0;
            // reset all bubbles
            const bubbles = document.querySelectorAll('.bubble');
            bubbles.forEach(bubble => {
                bubble.querySelector('.inner-bubble').classList.remove('default-bg-color');
            });
            // reset all bubble inputs
            const idCollectors = document.querySelectorAll('.side-bar-filter input.id-collector');
            idCollectors.forEach(idCollector => {
                idCollector.value = '';
            });
            // reset id-collector-count 
            const idCollectorCountElements =  document.querySelectorAll('.id-collector-count');
            idCollectorCountElements.forEach(idCollectorCountElement => {
                idCollectorCountElement.textContent = '';
            });
            // reset all filter by times
            const filterTimeInputs =  document.querySelectorAll('.filter-times input');
            filterTimeInputs.forEach(filterTimeInput => {
                filterTimeInput.value = '';
            });
            // reset main search
            document.querySelector('.main-search input').value = '';
        });
        // apply filter form
        document.querySelector('#filterForm').addEventListener("submit", function(event) {
            event.preventDefault();
            // get first part of link
            let url = this.closest('.side-bar-filter').dataset.link;
            // set default link options array
            const linkOptions = [];
            // check and see what other parameters we have and then set them
            // * order by
                const checkedCheckBoxes = document.querySelectorAll('.sort-by-item input[type="checkbox"]:checked');
                let orderByCheckBoxString = '';
                if (checkedCheckBoxes.length > 0) {
                    // storing the last item in the array
                    const lastElement = checkedCheckBoxes[checkedCheckBoxes.length - 1];
                    orderByCheckBoxString = 'sortBy=';
                    checkedCheckBoxes.forEach(element => {
                        // check whether it's ascending or descending
                        let sortOrder = '';
                        const sortOrderIcon = element.closest('.sort-by-item').querySelector('i')
                        if (
                            sortOrderIcon.classList.contains('fa-sort-numeric-down-alt') || 
                            sortOrderIcon.classList.contains('fa-sort-alpha-down-alt')
                        ) {
                            sortOrder = '::highToLow';
                        } 
                        // start building the string
                        const orderBy = element.name;
                        orderByCheckBoxString = orderByCheckBoxString + orderBy + sortOrder;
                        if (!(element === lastElement)) {
                            orderByCheckBoxString = orderByCheckBoxString + ',';    
                        }
                    });
                    // add to link options
                    linkOptions.push(orderByCheckBoxString);
                }
            // * stars
                const stars = document.querySelector(".filter-by-stars input[name=stars]").value;
                if (stars > 0) {
                    // add to link options
                    linkOptions.push(`stars=${stars}`);
                }
            // * categories
                const categories = document.querySelector("input[name=categories].id-collector").value;
                if (categories.length > 0) {
                    // add to link options
                    linkOptions.push(`categories=${categories}`);
                }
            // * tags
                const tags = document.querySelector("input[name=tags].id-collector").value;
                if (tags.length > 0) {
                    // add to link options
                    linkOptions.push(`tags=${tags}`);
                }
            // * allergies
                const allergies = document.querySelector("input[name=allergies].id-collector").value;
                if (allergies.length > 0) {
                    // add to link options
                    linkOptions.push(`allergies=${allergies}`);
                }
            // * prep time
                let prepTimeMin = document.querySelector(".filter-times input[name=prepMin]").value;
                let prepTimeMax = document.querySelector(".filter-times input[name=prepMax]").value;
                if (prepTimeMin > 0 || prepTimeMax > 0) {
                    // check too make sure we have numbers for both
                    if (isNaN(prepTimeMin) || prepTimeMin == '' || prepTimeMin < 0) {
                        prepTimeMin = 0;   
                    }
                    if (isNaN(prepTimeMax) || prepTimeMax == '' || prepTimeMax > 480) {
                        prepTimeMax = 480;   
                    }
                    // add to link options
                    linkOptions.push(`prepTime=${prepTimeMin},${prepTimeMax}`);
                }
            // * cook time
                let cookTimeMin = document.querySelector(".filter-times input[name=cookMin]").value;
                let cookTimeMax = document.querySelector(".filter-times input[name=cookMax]").value;
                if (cookTimeMin > 0 || cookTimeMax > 0) {
                    // check too make sure we have numbers for both
                    if (isNaN(cookTimeMin) || cookTimeMin == '' || cookTimeMin < 0) {
                        cookTimeMin = 0;   
                    }
                    if (isNaN(cookTimeMax) || cookTimeMax == '' || cookTimeMax > 480) {
                        cookTimeMax = 480;   
                    }
                    // add to link options
                    linkOptions.push(`cookTime=${cookTimeMin},${cookTimeMax}`);
                }
            // * total time
                let totalTimeMin = document.querySelector(".filter-times input[name=totalMin]").value;
                let totalTimeMax = document.querySelector(".filter-times input[name=totalMax]").value;
                if (totalTimeMin > 0 || totalTimeMax > 0) {
                    // check too make sure we have numbers for both
                    if (isNaN(totalTimeMin) || totalTimeMin == '' || totalTimeMin < 0) {
                        totalTimeMin = 0;   
                    }
                    if (isNaN(totalTimeMax) || totalTimeMax == '' || totalTimeMax > 480) {
                        totalTimeMax = 960;   
                    }
                    // add to link options
                    linkOptions.push(`totalTime=${totalTimeMin},${totalTimeMax}`);
                }
            // * title
                const title = document.querySelector(".main-search input").value;
                if (title.length > 0) {
                    linkOptions.push(`searchBy=${title}`);
                }

            // build final URL 
                if (linkOptions.length > 0) {
                    url = url + "?";
                    // storing the last item in the array
                    const lastOption = linkOptions[linkOptions.length - 1];
                    // add options
                    linkOptions.forEach(option => {
                        url = url + option;
                        if (!(option === lastOption)) {
                            url = url + '&';
                        }
                    });
                    
                }

            // redirect to the given page
            window.location.href = url;
        });
        // set search field to submit filter
        const mainSearchFiled = document.querySelector('.main-search input');
        if (mainSearchFiled) {
            mainSearchFiled.addEventListener("keyup", function(event) {
                // check to see if we press the enter key
                if (event.keyCode === 13) {
                  event.preventDefault();
                  document.querySelector('#applyFilter').click();
                }
            });
        }
    }

// # =================================================
// # bottom bar nav
// # =================================================

    document.querySelector('.chef-add').addEventListener("click", (event) => {
        event.stopPropagation();
        document.querySelector('.chef-add-menu').classList.toggle('open');
        document.querySelector('.chef-add').classList.toggle('active');
    });

    document.querySelector('.chef-add-menu').addEventListener("click", (event) => {
        event.stopPropagation();
    });

// # =================================================
// # general cleanup
// # =================================================

    // this fires whenever the document is clicked, so most places you click will trigger this
    document.querySelector('body').addEventListener("click", () => {
        const chefAddMenu = document.querySelector('.chef-add-menu');
        if (chefAddMenu.classList.contains('open')) {
            chefAddMenu.classList.toggle('open');
        }
        const chefAddBtn = document.querySelector('.chef-add');
        if (chefAddBtn.classList.contains('active')) {
            chefAddBtn.classList.toggle('active');
        }
    });