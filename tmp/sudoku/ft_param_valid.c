/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_param_valid.c                                   :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lucmarti <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/12 06:15:12 by lucmarti          #+#    #+#             */
/*   Updated: 2018/08/12 09:41:53 by lucmarti         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

int		ft_param_valid(int argc, char **argv)
{
	int		x_var;
	int		y_var;

	y_var = 1;
	if (argc != 10)
		return (0);
	while (y_var < 10)
	{
		x_var = 0;
		while (argv[y_var][x_var])
		{
			if (argv[y_var][x_var] != 46 && (argv[y_var][x_var] < 48
						|| argv[y_var][x_var] > 57))
				return (0);
			x_var++;
		}
		if (x_var != 9)
			return (0);
		y_var++;
	}
	return (1);
}
