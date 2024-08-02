CREATE TABLE ExercisesInWorkout (
    ExerciseInWorkoutID INT PRIMARY KEY AUTO_INCREMENT,
    WorkoutID INT,
    ExerciseID INT,
    Sets INT,
    Reps INT,
    Weight DECIMAL(10,2),
    RestTimeSeconds INT,
    FOREIGN KEY (WorkoutID) REFERENCES Workouts(WorkoutID),
    FOREIGN KEY (ExerciseID) REFERENCES Exercises(ExerciseID)
);