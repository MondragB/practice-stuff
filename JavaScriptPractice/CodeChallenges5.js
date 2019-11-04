// Write your function here:
function finalGrade(grade1, grade2, grade3){
    if ((grade1 < 0 || grade1 > 100) || (grade2 < 0 || grade2 > 100) || (grade3 < 0 || grade3 > 100)) {
      return 'You have entered an invalid grade.';
    }
    let average = (grade1+grade2+grade3)/3
    switch (true){
      case average >= 90:
        return 'A'
        break;
      case average >= 80:
        return 'B'
        break;
      case average >= 70:
        return 'C'
        break;
      case average >= 60:
        return 'D'
        break;
      case average >= 0:
        return 'F'
        break;
    }
  }
  // Uncomment the line below when you're ready to try out your function
  console.log(finalGrade(99, 92, 95)) // Should print 'A'
  console.log(finalGrade(79, 72, 75)) // Should print 'C'
  console.log(finalGrade(69, 62, 65)) // Should print 'D'
  console.log(finalGrade(89, 82, 85)) // Should print 'B'
  console.log(finalGrade(9, 2, 5)) // Should print 'F'
  
  // We encourage you to add more function calls of your own to test your code!