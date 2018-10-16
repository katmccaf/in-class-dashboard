var dashboardApp = new Vue({
  el: '#dashboard',
  data: {
    project: [
      {
        name : '',
        short_description: '',
        start_date : '',
        target_date : '',
        budget : '',
        spent : '',
        projected_spend: '',
        weekly_effort_target: ''
      }
    ],

    tasks: [
      {
        id: 0,
        title: '',
        type : '',
        size : '',
        team : '',
        status: '',
        start_date: '',
        close_date: null,
        hours_worked: '',
        perc_complete: '',
        current_sprint : ''
      }
    ]
  },

  computed: {
    days_left: function () {
      return moment(this.project.target_date).diff(moment(), 'days')
    }

  },
  methods: {
    pretty_date: function (d) {
      return moment(d).format('l')
    },

    pretty_currency: function (val) {
      if (val < 1e3) {
        return '$ ' + val
      }

      if (val <1e6) {
        return '$ ' + (val/1e3).toFixed(1) + ' k'
      }

      return '$ ' + (val/1e6).toFixed(1) + ' M'
    },

    complete_class: function(task) {
      if (task.perc_complete == 100 ) {
        return 'alert-success'
      }
      if (task.current_sprint && task.hours_worked == 0 ) {
        return 'alert-warning'
      }
    },

    fetchTasks () {

      fetch('https://github.com/tag/iu-msis/blob/video/app/data/p1-tasks.json')

      fetch('https://raw.githubusercontent.com/tag/iu-msis/video/app/data/p1-tasks.json')

      .then( response => response.json() )
      .then( json => {dashboardApp.tasks = json} )
      .catch( err => {
        console.log('TASK FETCH ERROR:');
        console.log(err);
      })
    },

    fetchProject () {
      fetch('https://raw.githubusercontent.com/tag/iu-msis/video/app/data/project1.json')
      .then( response => response.json() )
      .then( json => {dashboardApp.project = json} )
      .catch( err => {
        console.log('PROJECT FETCH ERROR:');
        console.log(err);
      })
    },

    fetchProjectWork () {
      fetch('api/workHours.php?projectId' +pid)
      .then( response => response.json() )
      .then( json => {dashboardApp.workHours = json} )
      .catch( err => {
        console.log('PROJECT FETCH ERROR:');
        console.log(err);
      })
    },

    formatWorkData() {
      this.workHours.forEach(
        function(entry, index, arr) {
          entry.date = Date.parse(entry.date);
          entry.hours = Number(entry.hours);
          entry.runningTotalHours = entry.hours
            + (index == 0 ? 0 : arr[index-1].runningTotalHours)
        }
      );
      console.log(this.workHours);
    },

    buildEffortChart() {
      Highcharts.chart('effortChart', {
          title: {
              text: 'Cumulative Effort'
          },
          xAxis: {
              type: 'datetime'
          },
          yAxis: {
              title: {
                  text: 'Hours'
              }
          },
          legend: {
              enabled: false
          },
          plotOptions: {
              area: {
                  fillColor: {
                      linearGradient: {
                          x1: 0,
                          y1: 0,
                          x2: 0,
                          y2: 1
                      },
                      stops: [
                          [0, Highcharts.getOptions().colors[0]],
                          [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                      ]
                  },
                  marker: {
                      radius: 2
                  },
                  lineWidth: 1,
                  states: {
                      hover: {
                          lineWidth: 1
                      }
                  },
                  threshold: null
              }
          },
          series: [{
              type: 'area',
              name: 'EFfort (hrs)',
              data: // Need [ [date1, val1], [date1, val2],... ]
                this.workHours.map( entry => [entry.date, entry.TotalRunningHours])
          }]
      });
    },

    gotoTask(tid) {
      //alert ('Clicked: ' + tid)
      window.location = 'task.html?taskId' + tid;
    }

  },
  created () {
    this.fetchProject();
    this.fetchProjectWork(1);
    this.fetchTasks();
  }
})
