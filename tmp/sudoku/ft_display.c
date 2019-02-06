/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_display.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lucmarti <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/12 06:14:21 by lucmarti          #+#    #+#             */
/*   Updated: 2018/08/12 09:11:40 by lucmarti         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "ft_func.h"

int		ft_display(char **sudoku)
{
	int		x_var;
	int		y_var;
	char	c;

	y_var = 0;
	while (y_var < 9)
	{
		x_var = 0;
		while (x_var < 9)
		{
			c = sudoku[y_var][x_var] + 48;
			write(1, &c, 1);
			x_var++;
			if (x_var < 9)
				write(1, &" ", 1);
		}
		write(1, &"\n", 1);
		y_var++;
	}
	return (0);
}
