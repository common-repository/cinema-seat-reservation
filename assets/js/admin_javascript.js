jQuery(function($) {

//alert("hello");
});
document.addEventListener("DOMContentLoaded", function() {
  const tabset = document.querySelector('.custom-tabset');
  const tabs = tabset.querySelectorAll('input[name="tabset"]');
  
  function handleTabChange() {
    const selectedTab = document.querySelector('input[name="tabset"]:checked');
    
    if (selectedTab) {
      const selectedTabIndex = Array.from(tabs).indexOf(selectedTab);
      localStorage.setItem('selectedTabIndex', selectedTabIndex);
    }
  }
  
  function showSelectedTab() {
    const storedIndex = localStorage.getItem('selectedTabIndex');
    
    if (storedIndex !== null) {
      tabs[storedIndex].checked = true;
      handleTabChange(); // Update local storage with the latest selected tab
    }
  }
  
  // Attach event listeners
  tabs.forEach(tab => {
    tab.addEventListener('change', handleTabChange);
  });
  
  // Show the initially selected or last selected tab on page load
  showSelectedTab();
});
