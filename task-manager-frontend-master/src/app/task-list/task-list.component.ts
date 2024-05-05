import {Component, OnInit} from '@angular/core';
import {TaskService} from "../task.service";
import {FormsModule} from "@angular/forms";
import {NgForOf} from "@angular/common";

@Component({
  selector: 'app-task-list',
  standalone: true,
  imports: [
    FormsModule,
    NgForOf
  ],
  templateUrl: './task-list.component.html',
  styleUrl: './task-list.component.scss'
})

export class TaskListComponent implements OnInit {
  tasks: any;
  newTask: any = {
    title: '',
    description: '',
    deadline: '',
    status: false
  };

  constructor(private taskService: TaskService) {
  }

  ngOnInit(): void {
    this.taskService.getTasks().subscribe(tasks => {
      this.tasks = tasks;
    });
  }

  addTask(): void {
    console.log(this.newTask);
    this.taskService.addTask(this.newTask).subscribe(task => {
      this.tasks.push(task);
      this.newTask = {};
    });
  }

  updateTask(updateTask: any): void {
    updateTask.completed = !updateTask.completed;
    this.taskService.updateTask(updateTask).subscribe(task => {
      this.ngOnInit();
    });
  }
}
