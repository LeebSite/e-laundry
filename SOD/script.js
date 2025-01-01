// Data proses
const processes = [
    { name: "P1", start: 0, duration: 7 },
    { name: "P3", start: 7, duration: 1 },
    { name: "P2", start: 8, duration: 4 },
    { name: "P4", start: 12, duration: 4 },
    { name: "P6", start: 16, duration: 3 },
    { name: "P5", start: 19, duration: 6 },
  ];
  
  // Total waktu
  const totalTime = 25; // Total waktu dalam skala
  
  // Referensi elemen
  const ganttChart = document.querySelector(".gantt-chart");
  const timeScale = document.querySelector(".time-scale");
  
  // Generate time scale
  for (let i = 0; i <= totalTime; i++) {
    const time = document.createElement("div");
    time.style.flex = "1";
    time.textContent = i;
    timeScale.appendChild(time);
  }
  
  // Generate bars
  processes.forEach((process) => {
    const bar = document.createElement("div");
    bar.className = "bar";
  
    // Set posisi dan ukuran bar
    bar.style.left = `${(process.start / totalTime) * 100}%`;
    bar.style.width = `${(process.duration / totalTime) * 100}%`;
    bar.textContent = `${process.name} (${process.start}-${process.start + process.duration})`;
  
    // Tambahkan ke Gantt Chart
    ganttChart.appendChild(bar);
  });
  