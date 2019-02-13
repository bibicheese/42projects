/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_swipe.c                                         :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: fpayen <marvin@42.fr>                      +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/11 18:49:52 by fpayen            #+#    #+#             */
/*   Updated: 2018/08/12 13:46:51 by hjamet           ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "ft_func.h"

int		compare_grid(char **sudoku, char **sudoku_rev)
{
	int i;
	int j;

	i = 0;
	j = 0;
	while (i < 9)
	{
		while (j < 9)
		{
			if (sudoku[i][j] != sudoku_rev[i][j])
				return (0);
			j++;
		}
		i++;
	}
	return (1);
}

int		ft_swipe(char **sudoku, int val)
{
	int x;
	int y;
	int i;

	x = val / 9;
	y = val % 9;
	i = 1;
	if (val >= 81)
		return (1);
	if (sudoku[x][y] != 0)
		return (ft_swipe(sudoku, val + 1));
	while (i < 10)
	{
		if (ft_is_valid(sudoku, x, y, i))
		{
			sudoku[x][y] = i;
			if (ft_swipe(sudoku, val + 1))
				return (1);
			else
				sudoku[x][y] = 0;
		}
		++i;
	}
	return (0);
}

int		ft_swipe_rev(char **sudoku, int val)
{
	int x;
	int y;
	int i;

	x = val / 9;
	y = val % 9;
	i = 9;
	if (val >= 81)
		return (1);
	if (sudoku[x][y] != 0)
		return (ft_swipe(sudoku, val + 1));
	while (i > 0)
	{
		if (ft_is_valid(sudoku, x, y, i))
		{
			sudoku[x][y] = i;
			if (ft_swipe(sudoku, val + 1))
				return (1);
			else
				sudoku[x][y] = 0;
		}
		i--;
	}
	return (0);
}
