/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_is_valid.c                                      :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lucmarti <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/12 06:34:38 by lucmarti          #+#    #+#             */
/*   Updated: 2018/08/12 12:13:45 by lucmarti         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <stdio.h>

int		get_square(int v)
{
	return (v - v % 3);
}

int		ft_is_valid(char **sudoku, int i, int j, char val)
{
	int var;
	int col;

	var = 0;
	while (var < 9)
	{
		if (sudoku[var][j] == val || sudoku[i][var] == val)
			return (0);
		++var;
	}
	var = 0;
	while (var < 3)
	{
		col = 0;
		while (col < 3)
		{
			if (sudoku[get_square(i) + var][get_square(j) + col] == val)
				return (0);
			++col;
		}
		++var;
	}
	return (1);
}
